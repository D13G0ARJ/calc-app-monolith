import { Injectable, inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

export interface Operation {
    id: number;
    num1: number;
    operator: string;
    num2: number;
    result: number;
    created_at: string;
}

@Injectable({
    providedIn: 'root'
})
export class CalculatorService {
    private http = inject(HttpClient);
    private apiUrl = environment.apiUrl;
    private storageKey = 'calculator_history';

    calculate(num1: number, operator: string, num2: number): Observable<Operation> {
        console.log('CalculatorService: Calling calculate API', `${this.apiUrl}/calculate`, { num1, operator, num2 });
        const request = this.http.post<Operation>(`${this.apiUrl}/calculate`, { num1, operator, num2 });
        
        // Tap into the response to save to local storage
        return new Observable<Operation>(observer => {
            request.subscribe({
                next: (response) => {
                    this.saveToHistory(response);
                    observer.next(response);
                    observer.complete();
                },
                error: (err) => observer.error(err)
            });
        });
    }

    getHistory(): Observable<Operation[]> {
        // Return history from local storage as an Observable to match previous signature
        const history = this.getLocalHistory();
        return new Observable(observer => {
            observer.next(history);
            observer.complete();
        });
    }

    private saveToHistory(operation: Operation): void {
        const history = this.getLocalHistory();
        history.unshift(operation); // Add to beginning
        // Limit to last 20 items like before
        const limitedHistory = history.slice(0, 20);
        localStorage.setItem(this.storageKey, JSON.stringify(limitedHistory));
    }

    private getLocalHistory(): Operation[] {
        const stored = localStorage.getItem(this.storageKey);
        return stored ? JSON.parse(stored) : [];
    }
}
