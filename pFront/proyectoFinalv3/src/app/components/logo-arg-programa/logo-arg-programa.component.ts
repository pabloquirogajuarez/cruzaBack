import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-logo-arg-programa',
  templateUrl: './logo-arg-programa.component.html',
  styleUrls: ['./logo-arg-programa.component.css']
})
export class LogoArgProgramaComponent implements OnInit{
  constructor(private router:Router) {}

  ngOnInit(): void {
  }

  login(){
    this.router.navigate(['/login'])
  }


}
