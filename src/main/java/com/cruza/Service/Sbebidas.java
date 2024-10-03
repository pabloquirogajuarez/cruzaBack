/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Service;

import com.cruza.Entity.Bebidas;
import java.util.List;
import java.util.Optional;
import javax.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.cruza.Repository.RBebidas;

/**
 *
 * @author Administrator
 */
@Transactional
@Service
public class Sbebidas {
    @Autowired
    RBebidas rhys;
    
    public List<Bebidas> list(){
        return rhys.findAll();
    }
    
    public Optional<Bebidas> getOne(int id){
        return rhys.findById(id);
    }
    
    public Optional<Bebidas> getByNombre(String nombre){
        return rhys.findByNombre(nombre);
    }
    
    public void save(Bebidas skill){
        rhys.save(skill);
    }
    
    public void delete(int id){
        rhys.deleteById(id);
    }
    
    public boolean existsById(int id){
        return rhys.existsById(id);
    }
    
    public boolean existsByNombre(String nombre){
        return rhys.existsByNombre(nombre);
    }
}
