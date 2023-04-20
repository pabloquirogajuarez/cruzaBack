import { Component, OnInit } from '@angular/core';
import { Edu } from 'src/app/model/edu';
import { EduService } from 'src/app/service/edu.service';
import { TokenService } from 'src/app/service/token.service';

@Component({
  selector: 'app-edu',
  templateUrl: './edu.component.html',
  styleUrls: ['./edu.component.css']
})
export class EduComponent implements OnInit {
  edu: Edu[] = [];

  constructor(private eduS: EduService, private tokenService: TokenService) { }
  isLogged = false;

  ngOnInit(): void {
    this.cargarEdu();
    if(this.tokenService.getToken()){
      this.isLogged = true;
    } else {
      this.isLogged = false;
    }
  }

  cargarEdu(): void{
    this.eduS.lista().subscribe(
      data =>{
        this.edu = data;
      }
    )
  }

  delete(id?: number){
    if( id != undefined){
      this.eduS.delete(id).subscribe(
        data => {
          this.cargarEdu();
        }, err => {
          alert("No se pudo eliminar");
        }
      )
    }
  }
}