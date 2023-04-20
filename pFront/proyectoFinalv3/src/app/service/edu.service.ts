import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Edu } from '../model/edu';

@Injectable({
  providedIn: 'root'
})
export class EduService {
  URL = 'https://localhost:8080/educacion';


  constructor(private httpClient : HttpClient) { }

  public lista(): Observable<Edu[]>{
    return this.httpClient.get<Edu[]>(this.URL + 'lista');
  }

  public detail(id: number): Observable<Edu>{
    return this.httpClient.get<Edu>(this.URL + `detail/${id}`);
  }

  public save(edu: Edu): Observable<any>{
    return this.httpClient.post<any>(this.URL + 'create', edu);
  }

  public update(id: number, edu: Edu): Observable<any>{
    return this.httpClient.put<any>(this.URL + `update/${id}`, edu);
  }

  public delete(id: number): Observable<any>{
    return this.httpClient.delete<any>(this.URL + `delete/${id}`);
  }
}
