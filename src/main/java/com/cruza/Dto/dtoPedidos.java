/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Dto;

import javax.validation.constraints.NotBlank;

/**
 *
 * @author Administrator
 */
public class dtoPedidos {
    @NotBlank
    private String numeroPedido;
    @NotBlank
     private String numeroMesaPedido;
    @NotBlank
    private String nombreClientePedido;
    @NotBlank
    private String horarioPedido;
    @NotBlank
    private String pedido;
    @NotBlank
    private String observacionesPedido;
    @NotBlank
    private String estadoPedido;
    @NotBlank
    private String precioPedido;

    public dtoPedidos() {
    }

    public dtoPedidos(String numeroPedido,String numeroMesaPedido, String nombreClientePedido, String horarioPedido, String pedido, String observacionesPedido, String estadoPedido, String precioPedido) {
        this.numeroPedido = numeroPedido;
        this.numeroMesaPedido=numeroMesaPedido;
        this.nombreClientePedido = nombreClientePedido;
        this.horarioPedido = horarioPedido;
        this.pedido = pedido;
        this.observacionesPedido = observacionesPedido;
        this.estadoPedido = estadoPedido;
        this.precioPedido = precioPedido;
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
