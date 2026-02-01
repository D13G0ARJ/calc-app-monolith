import { Routes } from '@angular/router';
import { CalculatorComponent } from './components/calculator/calculator.component';
import { HistoryComponent } from './components/history/history.component';

export const routes: Routes = [
    { path: '', component: CalculatorComponent },
    { path: 'history', component: HistoryComponent },
    { path: '**', redirectTo: '' }
];
