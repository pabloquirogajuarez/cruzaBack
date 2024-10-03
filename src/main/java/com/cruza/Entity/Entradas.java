/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cruza.Entity;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class Entradas {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;
    private String nombreE;
    private String descripcionE;
    private String fechaInicioE;
    private String fechaFinE;

    public Entradas() {
    }

    public Entradas(String nombreE, String descripcionE, String fechaInicioE, String fechaFinE) {
        this.nombreE = nombreE;
        this.descripcionE = descripcionE;
        this.fechaInicioE = fechaInicioE;
        this.fechaFinE = fechaFinE;
    }


    //getters setters

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNombreE() {
        return nombreE;
    }

    public void setNombreE(String nombreE) {
        this.nombreE = nombreE;
    }

    public String getDescripcionE() {
        return descripcionE;
    }

    public void setDescripcionE(String descripcionE) {
        this.descripcionE = descripcionE;
    }

    public String getFechaInicioE() {
        return fechaInicioE;
    }

    public void setFechaInicioE(String fechaInicioE) {
        this.fechaInicioE = fechaInicioE;
    }

    public String getFechaFinE() {
        return fechaFinE;
    }

    public void setFechaFinE(String fechaFinE) {
        this.fechaFinE = fechaFinE;
    }
    
    
    
    
}
