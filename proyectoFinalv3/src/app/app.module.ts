import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { LogoArgProgramaComponent } from './components/logo-arg-programa/logo-arg-programa.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LogoArgProgramaComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
