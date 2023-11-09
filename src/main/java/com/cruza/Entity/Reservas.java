/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Entity;

import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

/**
 *
 * @author pablop
 */
public class Reservas {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;
    private String numeroReserva;
    private String nombreClienteReserva;
    private String telefonoReserva;
    private String fechaReserva;
    private String horaReserva;
    private String numeroPersonasReserva;
    private String eventoReserva;
    private String observacionesReserva;

    public Reservas() {
    }

    public Reservas(String numeroReserva, String nombreClienteReserva, String telefonoReserva, String fechaReserva, String horaReserva, String numeroPersonasReserva, String eventoReserva, String observacionesReserva) {
        this.numeroReserva = numeroReserva;
        this.nombreClienteReserva = nombreClienteReserva;
        this.telefonoReserva = telefonoReserva;
        this.fechaReserva = fechaReserva;
        this.horaReserva = horaReserva;
        this.numeroPersonasReserva = numeroPersonasReserva;
        this.eventoReserva = eventoReserva;
        this.observacionesReserva = observacionesReserva;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
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
