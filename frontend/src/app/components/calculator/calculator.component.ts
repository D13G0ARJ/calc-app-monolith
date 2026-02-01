import { Component, inject, ChangeDetectorRef, HostListener } from '@angular/core';
import { ThemeService } from '../../services/theme.service';
import { CommonModule, DecimalPipe } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { CalculatorService, Operation } from '../../services/calculator.service';
import { RouterModule } from '@angular/router';

@Component({
    selector: 'app-calculator',
    standalone: true,
    imports: [CommonModule, FormsModule, RouterModule, DecimalPipe],
    templateUrl: './calculator.component.html',
    styleUrl: './calculator.component.css'
})
export class CalculatorComponent {
    private calculatorService = inject(CalculatorService);
    public themeService = inject(ThemeService);
    private cdr = inject(ChangeDetectorRef);

    displayValue: string = '0';
    firstOperand: number | null = null;
    operator: string | null = null;
    waitingForSecondOperand: boolean = false;

    loading = false;
    errorMessage: string | null = null;

    inputDigit(digit: string) {
        if (this.waitingForSecondOperand) {
            this.displayValue = digit;
            this.waitingForSecondOperand = false;
        } else {
            this.displayValue = this.displayValue === '0' ? digit : this.displayValue + digit;
        }
        this.errorMessage = null;
    }

    inputDecimal() {
        if (this.waitingForSecondOperand) {
            this.displayValue = '0.';
            this.waitingForSecondOperand = false;
            return;
        }

        if (!this.displayValue.includes('.')) {
            this.displayValue += '.';
        }
    }

    handleOperator(nextOperator: string) {
        const inputValue = parseFloat(this.displayValue);

        if (this.operator && this.waitingForSecondOperand) {
            this.operator = nextOperator;
            return;
        }

        if (this.firstOperand === null) {
            this.firstOperand = inputValue;
        } else if (this.operator) {
            // Encadenamiento: 10 + 10 + -> Calcula 20, luego establece el operador a +
            this.calculate(nextOperator);
            return;
        }

        this.operator = nextOperator;
        this.waitingForSecondOperand = true;
        this.errorMessage = null;
    }



    calculate(nextOperator: string | null = null) {
        if (this.firstOperand === null || this.operator === null) return;

        const secondOperand = parseFloat(this.displayValue);

        if (this.operator === '/' && secondOperand === 0) {
            this.errorMessage = 'Cannot divide by zero';
            this.displayValue = 'Error';
            this.resetStateAfterError();
            this.cdr.detectChanges();
            return;
        }

        this.loading = true;

        this.calculatorService.calculate(this.firstOperand, this.operator, secondOperand).subscribe({
            next: (res) => {
                console.log('CalculatorComponent: Success', res);
                this.displayValue = String(res.result);
                this.firstOperand = res.result; // Actualizar "Memoria" con el resultado
                this.loading = false;

                // Si fue una operación encadenada (ej: 10 + 10 *), nextOperator es '*'
                // Si fue '=', nextOperator es null.
                this.operator = nextOperator;
                this.waitingForSecondOperand = true;
                this.errorMessage = null;

                this.cdr.detectChanges();
            },
            error: (err) => {
                console.error('CalculatorComponent: Error calculating', err);
                this.loading = false;
                this.errorMessage = 'Error';
                this.displayValue = 'Error';
                this.resetStateAfterError();
                this.cdr.detectChanges();
            }
        });
    }

    reset() {
        this.displayValue = '0';
        this.firstOperand = null;
        this.operator = null;
        this.waitingForSecondOperand = false;
        this.errorMessage = null;
        this.loading = false;
    }

    resetStateAfterError() {
        this.firstOperand = null;
        this.operator = null;
        this.waitingForSecondOperand = false;
    }

    @HostListener('window:keydown', ['$event'])
    handleKeyboardEvent(event: KeyboardEvent) {
        const key = event.key;

        // Numbers 0-9
        if (/^[0-9]$/.test(key)) {
            event.preventDefault();
            this.inputDigit(key);
            return;
        }

        // Operators
        if (['+', '-', '*', '/'].includes(key)) {
            event.preventDefault();
            this.handleOperator(key);
            return;
        }

        // Decimal
        if (key === '.' || key === ',') {
            event.preventDefault();
            this.inputDecimal();
            return;
        }

        // Calculate (Enter or =)
        if (key === 'Enter' || key === '=') {
            event.preventDefault();
            this.calculate();
            return;
        }

        // Reset (Escape)
        if (key === 'Escape') {
            event.preventDefault();
            this.reset();
            return;
        }

        // Backspace
        if (key === 'Backspace') {
            event.preventDefault();
            this.handleBackspace();
            return;
        }
    }

    handleBackspace() {
        if (this.waitingForSecondOperand) return;

        if (this.displayValue.length > 1) {
            this.displayValue = this.displayValue.slice(0, -1);
        } else {
            this.displayValue = '0';
        }
    }
}
