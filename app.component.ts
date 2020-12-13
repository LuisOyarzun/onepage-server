import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { PhpService } from './services/php.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'samuel';

  constructor(
    private _http: HttpClient,
    private servicio: PhpService
  ) {

    //MÉTODO POST
    this._http.post('http://localhost:8080/api/mensaje', {
      params: {
        id: 'test'
      }
    }
    )
    .subscribe(
      data => console.log(data),
      err => console.log(err),
      () => console.log("Finalizada") 
    )

    //MÉTODO GET
/*     this._http.get('http://localhost:8080/api/mensaje', {
      responseType: 'text',
      headers: {
        'Content-Type': 'application/json'
      }
    }
    )
    .subscribe(
      data => console.log(data),
      err => console.log(err),
      () => console.log("Finalizada") 
    ) */
  }
}
