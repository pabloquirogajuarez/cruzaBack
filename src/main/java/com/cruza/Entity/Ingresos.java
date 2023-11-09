/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Entity;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

/**
 *
 * @author pablop
 */
@Entity
public class Ingresos {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;
    private String fechaIngreso;
    private String gananciaIngreso;

    public Ingresos() {
    }

    public Ingresos(String fechaIngreso, String gananciaIngreso) {
        this.fechaIngreso = fechaIngreso;
        this.gananciaIngreso = gananciaIngreso;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getFechaIngreso() {
        return fechaIngreso;
    }

    public void setFechaIngreso(String fechaIngreso) {
        this.fechaIngreso = fechaIngreso;
    }

    public String getGananciaIngreso() {
        return gananciaIngreso;
    }

    public void setGananciaIngreso(String gananciaIngreso) {
        this.gananciaIngreso = gananciaIngreso;
    }
    
    
    
}
