import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LogoArgProgramaComponent } from './logo-arg-programa.component';

describe('LogoArgProgramaComponent', () => {
  let component: LogoArgProgramaComponent;
  let fixture: ComponentFixture<LogoArgProgramaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ LogoArgProgramaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(LogoArgProgramaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
