package com.cruza.Service;
import com.cruza.Entity.Ingresos;
import com.cruza.Repository.RIngresos;
import java.util.List;
import java.util.Optional;
import javax.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;


@Service
@Transactional
public class SIngresos {
    @Autowired
    RIngresos rIngresos;
    
    public List<Ingresos> list(){
        return rIngresos.findAll();
    }
    
    public Optional<Ingresos> getOne(int id){
        return rIngresos.findById(id);
    }
    
    public Optional<Ingresos> getByfechaIngreso(String fechaIngreso){
        return rIngresos.findByfechaIngreso(fechaIngreso);
    }
    
    public void save(Ingresos ingresos){
        rIngresos.save(ingresos);
    }
    
    public void delete(int id){
        rIngresos.deleteById(id);
    }
    
    public boolean existsById(int id){
        return rIngresos.existsById(id);
    }
    
    public boolean existsByfechaIngreso(String fechaIngreso){
        return rIngresos.existsByfechaIngreso(fechaIngreso);
    }
    
}
