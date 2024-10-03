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
public class dtoReservas {
    @NotBlank
    private String numeroReserva;
    @NotBlank
    private String nombreClienteReserva;
    @NotBlank
    private String telefonoReserva;
    @NotBlank
    private String fechaReserva;
    @NotBlank
    private String horaReserva;
    @NotBlank
    private String numeroPersonasReserva;
    @NotBlank
    private String eventoReserva;
    @NotBlank
    private String observacionesReserva;
    
    //constructor

    public dtoReservas() {
    }

    public dtoReservas(String numeroReserva, String nombreClienteReserva, String telefonoReserva, String fechaReserva, String horaReserva, String numeroPersonasReserva, String eventoReserva, String observacionesReserva) {
        this.numeroReserva = numeroReserva;
        this.nombreClienteReserva = nombreClienteReserva;
        this.telefonoReserva = telefonoReserva;
        this.fechaReserva = fechaReserva;
        this.horaReserva = horaReserva;
        this.numeroPersonasReserva = numeroPersonasReserva;
        this.eventoReserva = eventoReserva;
        this.observacionesReserva = observacionesReserva;
    }

    public String getNumeroReserva() {
        return numeroReserva;
    }

    public void setNumeroReserva(String numeroReserva) {
        this.numeroReserva = numeroReserva;
    }

    public String getNombreClienteReserva() {
        return nombreClienteReserva;
    }

    public void setNombreClienteReserva(String nombreClienteReserva) {
        this.nombreClienteReserva = nombreClienteReserva;
    }

    public String getTelefonoReserva() {
        return telefonoReserva;
    }

    public void setTelefonoReserva(String telefonoReserva) {
        this.telefonoReserva = telefonoReserva;
    }

    public String getFechaReserva() {
        return fechaReserva;
    }

    public void setFechaReserva(String fechaReserva) {
        this.fechaReserva = fechaReserva;
    }

    public String getHoraReserva() {
        return horaReserva;
    }

    public void setHoraReserva(String horaReserva) {
        this.horaReserva = horaReserva;
    }

    public String getNumeroPersonasReserva() {
        return numeroPersonasReserva;
    }

    public void setNumeroPersonasReserva(String numeroPersonasReserva) {
        this.numeroPersonasReserva = numeroPersonasReserva;
    }

    public String getEventoReserva() {
        return eventoReserva;
    }

    public void setEventoReserva(String eventoReserva) {
        this.eventoReserva = eventoReserva;
    }

    public String getObservacionesReserva() {
        return observacionesReserva;
    }

    public void setObservacionesReserva(String observacionesReserva) {
        this.observacionesReserva = observacionesReserva;
    }
    
    
}
