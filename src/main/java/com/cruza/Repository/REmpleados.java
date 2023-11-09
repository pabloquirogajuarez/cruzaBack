/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package com.cruza.Repository;

import com.cruza.Entity.Empleados;
import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

/**
 *
 * @author pablop
 */
@Repository
public interface REmpleados extends JpaRepository<Empleados, Integer>{
    public Optional<Empleados> findBynombreEmpleado(String nombreEmpleado);
    public boolean existsBynombreEmpleado(String nombreEmpleado);
}
