/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Entity;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class Pedidos {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;
    private String numeroPedido;
    private String numeroMesaPedido;
    private String nombreClientePedido;
    private String horarioPedido;
    private String pedido;
    private String observacionesPedido;
    private String estadoPedido;
    private String precioPedido;

    public Pedidos() {
    }

    public Pedidos(String numeroPedido, String numeroMesaPedido, String nombreClientePedido, String horarioPedido, String pedido, String observacionesPedido, String estadoPedido, String precioPedido) {
        this.numeroPedido = numeroPedido;
        this.numeroMesaPedido = numeroMesaPedido;
        this.nombreClientePedido = nombreClientePedido;
        this.horarioPedido = horarioPedido;
        this.pedido = pedido;
        this.observacionesPedido = observacionesPedido;
        this.estadoPedido = estadoPedido;
        this.precioPedido = precioPedido;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNumeroPedido() {
        return numeroPedido;
    }

    public void setNumeroPedido(String numeroPedido) {
        this.numeroPedido = numeroPedido;
    }

    public String getNumeroMesaPedido() {
        return numeroMesaPedido;
    }

    public void setNumeroMesaPedido(String numeroMesaPedido) {
        this.numeroMesaPedido = numeroMesaPedido;
    }

    public String getNombreClientePedido() {
        return nombreClientePedido;
    }

    public void setNombreClientePedido(String nombreClientePedido) {
        this.nombreClientePedido = nombreClientePedido;
    }

    public String getHorarioPedido() {
        return horarioPedido;
    }

    public void setHorarioPedido(String horarioPedido) {
        this.horarioPedido = horarioPedido;
    }

    public String getPedido() {
        return pedido;
    }

    public void setPedido(String pedido) {
        this.pedido = pedido;
    }

    public String getObservacionesPedido() {
        return observacionesPedido;
    }

    public void setObservacionesPedido(String observacionesPedido) {
        this.observacionesPedido = observacionesPedido;
    }

    public String getEstadoPedido() {
        return estadoPedido;
    }

    public void setEstadoPedido(String estadoPedido) {
        this.estadoPedido = estadoPedido;
    }

    public String getPrecioPedido() {
        return precioPedido;
    }

    public void setPrecioPedido(String precioPedido) {
        this.precioPedido = precioPedido;
    }

}
