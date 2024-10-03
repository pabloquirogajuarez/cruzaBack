/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package com.cruza.Repository;

import com.cruza.Entity.Reservas;
import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;



@Repository
public interface RReservas extends JpaRepository<Reservas, Integer>{
    public Optional<Reservas> findBynumeroReserva(String numeroReserva);
    public boolean existsBynumeroReserva(String numeroReserva);
}
