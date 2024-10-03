/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package com.cruza.Repository;

import com.cruza.Entity.Bebidas;
import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;

/**
 *
 * @author Administrator
 */
public interface RBebidas extends JpaRepository<Bebidas, Integer>{
    Optional<Bebidas> findByNombre(String nombre);
    public boolean existsByNombre(String nombre);
}
