
package com.portfolio.pabloquirogajuarez.Interface;

import com.portfolio.pabloquirogajuarez.Entity.Persona;
import java.util.List;

public interface IPersonaService {
    //traer una lista de persona
    public List<Persona> getPersona();
    
    //guardar un objeto de tipo persona
    public void savePersona(Persona persona);
    
    
    //eliminar un objeto pero lo buscamos por id
    public void deletePersona(Long id);
    
    
    //buscar persona
    public Persona findPersona(Long id);
}
