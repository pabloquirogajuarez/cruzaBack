
package com.portfolio.pabloquirogajuarez.Entity;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;
import lombok.Getter;
import lombok.Setter;

@Getter @Setter
@Entity
public class Persona {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    
    @NotNull //el NotNull se aplica a lo de abajo.
    @Size(min = 1, max = 50, message = "No cumple con la longitud")
    private String nombre;
    
    @NotNull 
    @Size(min = 1, max = 50, message = "No cumple con la longitud")    
    private String apellido;
    
    @Size(min = 1, max = 50, message = "No cumple con la longitud")    
    private String img;
    
    //getters y setters ya importados por lombook para no poner "insert code" 
    // y que esto quede lardo.
    
}
