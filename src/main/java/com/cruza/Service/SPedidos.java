/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Service;

import com.cruza.Entity.Pedidos;
import com.cruza.Repository.RPedidos;
import java.util.List;
import java.util.Optional;
import javax.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;


@Service
@Transactional
public class SPedidos {
    @Autowired
    RPedidos rPedidos;
    
    public List<Pedidos> list(){
        return rPedidos.findAll();
    }
    
    public Optional<Pedidos> getOne(int id){
        return rPedidos.findById(id);
    }
    
    public Optional<Pedidos> getBynumeroPedido(String numeroPedido){
        return rPedidos.findBynumeroPedido(numeroPedido);
    }
    
    public void save(Pedidos pedidos){
        rPedidos.save(pedidos);
    }
    
    public void delete(int id){
        rPedidos.deleteById(id);
    }
    
    public boolean existsById(int id){
        return rPedidos.existsById(id);
    }
    
    public boolean existsBynumeroPedido(String numeroPedido){
        return rPedidos.existsBynumeroPedido(numeroPedido);
    }
    
}
