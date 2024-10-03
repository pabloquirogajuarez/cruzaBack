/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package com.cruza.Repository;

import com.cruza.Entity.Ingresos;
import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

/**
 *
 * @author pablop
 */
@Repository
public interface RIngresos extends JpaRepository<Ingresos, Integer>{
    public Optional<Ingresos> findByfechaIngreso(String fechaIngreso);
    public boolean existsByfechaIngreso(String fechaIngreso);
}
