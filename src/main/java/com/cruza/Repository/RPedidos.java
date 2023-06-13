/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package com.cruza.Repository;

import com.cruza.Entity.Pedidos;
import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;



@Repository
public interface RPedidos extends JpaRepository<Pedidos, Integer>{
    public Optional<Pedidos> findBynumeroPedido(String numeroPedido);
    public boolean existsBynumeroPedido(String numeroPedido);
}
