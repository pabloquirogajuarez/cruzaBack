/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cruza.Service;

import com.cruza.Entity.Principal;
import java.util.List;
import java.util.Optional;
import javax.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.cruza.Repository.RPrincipal;

@Service
@Transactional
public class SPrincipal {
     @Autowired
     RPrincipal rExperiencia;
     
     public List<Principal> list(){
         return rExperiencia.findAll();
     }
     
     public Optional<Principal> getOne(int id){
         return rExperiencia.findById(id);
     }
     
     public Optional<Principal> getByNombreE(String nombreE){
         return rExperiencia.findByNombreE(nombreE);
     }
     
     public void save(Principal expe){
         rExperiencia.save(expe);
     }
     
     public void delete(int id){
         rExperiencia.deleteById(id);
     }
     
     public boolean existsById(int id){
         return rExperiencia.existsById(id);
     }
     
     public boolean existsByNombreE(String nombreE){
         return rExperiencia.existsByNombreE(nombreE);
     }
}
