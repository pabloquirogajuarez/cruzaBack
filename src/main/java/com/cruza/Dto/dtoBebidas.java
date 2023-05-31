/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Dto;

/**
 *
 * @author Administrator
 */
import javax.validation.constraints.NotBlank; //para indicar que el campo no puede estar vacio


public class dtoBebidas {
    @NotBlank
    private String nombre;
    @NotBlank
    private int porcentaje;

    public dtoBebidas() {
    }

    public dtoBebidas(String nombre, int porcentaje) {
        this.nombre = nombre;
        this.porcentaje = porcentaje;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public int getPorcentaje() {
        return porcentaje;
    }

    public void setPorcentaje(int porcentaje) {
        this.porcentaje = porcentaje;
    }
    
    
}
