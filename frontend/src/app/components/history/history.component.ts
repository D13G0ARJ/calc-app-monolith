import { Component, OnInit, inject, ChangeDetectorRef } from '@angular/core';
import { CommonModule, DatePipe } from '@angular/common';
import { CalculatorService, Operation } from '../../services/calculator.service';
import { RouterModule } from '@angular/router';

@Component({
    selector: 'app-history',
    standalone: true,
    imports: [CommonModule, RouterModule, DatePipe],
    templateUrl: './history.component.html',
    styleUrl: './history.component.css'
})
export class HistoryComponent implements OnInit {
    private calculatorService = inject(CalculatorService);
    private cdr = inject(ChangeDetectorRef);

    history: Operation[] = [];
    loading = true;

    ngOnInit() {
        this.loadHistory();
    }

    loadHistory() {
        this.loading = true;
        this.calculatorService.getHistory().subscribe({
            next: (data) => {
                console.log('History fetched', data);
                this.history = data;
                this.loading = false;
                this.cdr.detectChanges();
            },
            error: (err) => {
                console.error('Failed to load history', err);
                this.loading = false;
                this.cdr.detectChanges();
            }
        });
    }
}
