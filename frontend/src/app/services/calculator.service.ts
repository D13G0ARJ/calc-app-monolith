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

    calculate(num1: number, operator: string, num2: number): Observable<Operation> {
        console.log('CalculatorService: Calling calculate API', `${this.apiUrl}/calculate`, { num1, operator, num2 });
        return this.http.post<Operation>(`${this.apiUrl}/calculate`, { num1, operator, num2 });
    }

    getHistory(): Observable<Operation[]> {
        return this.http.get<Operation[]>(`${this.apiUrl}/history`);
    }
}
