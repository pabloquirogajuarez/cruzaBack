/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cruza.Service;

import com.cruza.Entity.Entradas;
import java.util.List;
import java.util.Optional;
import javax.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.cruza.Repository.REntradas;

@Service
@Transactional
public class Sentradas {
    @Autowired
    REntradas rEducacion;
    
    public List<Entradas> list(){
        return rEducacion.findAll();
    }
    
    public Optional<Entradas> getOne(int id){
        return rEducacion.findById(id);
    }
    
    public Optional<Entradas> getByNmbreE(String nombreE){
        return rEducacion.findByNombreE(nombreE);
    }
    
    public void save(Entradas educacion){
        rEducacion.save(educacion);
    }
    
    public void delete(int id){
        rEducacion.deleteById(id);
    }
    
    public boolean existsById(int id){
        return rEducacion.existsById(id);
    }
    
    public boolean existsByNombreE(String nombreE){
        return rEducacion.existsByNombreE(nombreE);
    }
}
