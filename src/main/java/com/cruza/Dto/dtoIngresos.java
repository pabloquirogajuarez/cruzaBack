/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Dto;

import javax.validation.constraints.NotBlank;

/**
 *
 * @author pablop
 */
public class dtoIngresos {
    @NotBlank
    private String fechaIngreso;
    @NotBlank
    private String gananciaIngreso;

    public dtoIngresos() {
    }

    public dtoIngresos(String fechaIngreso, String gananciaIngreso) {
        this.fechaIngreso = fechaIngreso;
        this.gananciaIngreso = gananciaIngreso;
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
