import { RouterModule, Routes } from '@angular/router';
import { CadastroComponent } from './cadastro/cadastro.component';
import { listagemComponent } from './listagem/listagem.component';

const appRoutes : Routes = [
    { path:'', component: listagemComponent },
    { path:'cadastro', component: CadastroComponent },
    { path:'**', component: listagemComponent },

];
export const routing = RouterModule.forRoot(appRoutes);