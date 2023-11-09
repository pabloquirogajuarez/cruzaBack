package com.cruza.Service;
import com.cruza.Entity.Reservas;
import com.cruza.Repository.RReservas;
import java.util.List;
import java.util.Optional;
import javax.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;


@Service
@Transactional
public class SReservas {
    @Autowired
    RReservas rReservas;
    
    public List<Reservas> list(){
        return rReservas.findAll();
    }
    
    public Optional<Reservas> getOne(int id){
        return rReservas.findById(id);
    }
    
    public Optional<Reservas> getBynumeroReserva(String numeroReserva){
        return rReservas.findBynumeroReserva(numeroReserva);
    }
    
    public void save(Reservas reservas){
        rReservas.save(reservas);
    }
    
    public void delete(int id){
        rReservas.deleteById(id);
    }
    
    public boolean existsById(int id){
        return rReservas.existsById(id);
    }
    
    public boolean existsBynumeroReserva(String numeroReserva){
        return rReservas.existsBynumeroReserva(numeroReserva);
    }
    
}
