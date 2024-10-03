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
public class dtoEmpleados {
        @NotBlank
    private String nombreEmpleado;
    @NotBlank
    private String rolEmpleado;

    public dtoEmpleados() {
    }

    public dtoEmpleados(String nombreEmpleado, String rolEmpleado) {
        this.nombreEmpleado = nombreEmpleado;
        this.rolEmpleado = rolEmpleado;
    }

    public String getNombreEmpleado() {
        return nombreEmpleado;
    }

    public void setNombreEmpleado(String nombreEmpleado) {
        this.nombreEmpleado = nombreEmpleado;
    }

    public String getRolEmpleado() {
        return rolEmpleado;
    }

    public void setRolEmpleado(String rolEmpleado) {
        this.rolEmpleado = rolEmpleado;
    }
    
    
}
