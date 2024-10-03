package com.cruza.Service;
import com.cruza.Entity.Empleados;
import com.cruza.Repository.REmpleados;
import java.util.List;
import java.util.Optional;
import javax.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;


@Service
@Transactional
public class SEmpleados {
    @Autowired
    REmpleados rEmpleados;
    
    public List<Empleados> list(){
        return rEmpleados.findAll();
    }
    
    public Optional<Empleados> getOne(int id){
        return rEmpleados.findById(id);
    }
    
    public Optional<Empleados> getBynombreEmpleado(String nombreEmpleado){
        return rEmpleados.findBynombreEmpleado(nombreEmpleado);
    }
    
    public void save(Empleados empleados){
        rEmpleados.save(empleados);
    }
    
    public void delete(int id){
        rEmpleados.deleteById(id);
    }
    
    public boolean existsById(int id){
        return rEmpleados.existsById(id);
    }
    
    public boolean existsBynombreEmpleado(String nombreEmpleado){
        return rEmpleados.existsBynombreEmpleado(nombreEmpleado);
    }
    
}
