import { NgModule }                         from '@angular/core';
import { BrowserModule }                    from '@angular/platform-browser';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppComponent }                     from './app.component';
import { FotoModule }                       from './foto/foto.module';
import { HttpModule }                       from '@angular/http';
import { PainelModule }                     from './painel/painel.module';
import { CadastroComponent }                from './cadastro/cadastro.component';
import { listagemComponent }                from './listagem/listagem.component';
import { routing }                          from './app.routes';


import 'rxjs/add/operator/map'; // permite map() em todas as instancias de um observable;


@NgModule({
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    FotoModule,
    HttpModule,
    PainelModule, 
    routing 
  ],
  
  declarations: [
    AppComponent,
    CadastroComponent,
    listagemComponent
  ],
  
  bootstrap:    [ AppComponent ]
})
export class AppModule { }