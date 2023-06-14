/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Controller;

import com.cruza.Dto.dtoPedidos;
import com.cruza.Entity.Pedidos;
import com.cruza.Security.Controller.Mensaje;
import com.cruza.Service.SPedidos;
import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.media.Content;
import io.swagger.v3.oas.annotations.media.Schema;
import io.swagger.v3.oas.annotations.responses.ApiResponse;
import io.swagger.v3.oas.annotations.responses.ApiResponses;
import java.awt.print.Book;
import java.util.List;
import org.apache.commons.lang3.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

/**
 *
 * @author Administrator
 */
@RestController
@RequestMapping("/pedidos")
@CrossOrigin(origins = {"https://cruzafront.web.app", "http://localhost:4200"})
public class CPedidos {

    @Autowired
    SPedidos sPedidos;

    @Operation(summary = "Trae una lista de los pedidos creados")
    @GetMapping("/lista")
    public ResponseEntity<List<Pedidos>> list() {
        List<Pedidos> list = sPedidos.list();
        return new ResponseEntity(list, HttpStatus.OK);
    }

    @Operation(summary = "Según los id's obtenidos en pedidos/lista, puedes ver la informacion puedes ver la informacion de la misma")
    @GetMapping("/detail/{id}")
    public ResponseEntity<Pedidos> getById(@PathVariable("id") int id) {
        if (!sPedidos.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.BAD_REQUEST);
        }

        Pedidos pedidos = sPedidos.getOne(id).get();
        return new ResponseEntity(pedidos, HttpStatus.OK);
    }

    @Operation(summary = "Borrar un pedido por id")
    @PreAuthorize("hasRole('ADMIN')")
    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id) {
        if (!sPedidos.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        sPedidos.delete(id);
        return new ResponseEntity(new Mensaje("Pedido eliminado"), HttpStatus.OK);
    }

    @Operation(summary = "Crear un pedido")
    @PreAuthorize("hasRole('ADMIN')")
    @PostMapping("/create")
    public ResponseEntity<?> create(@RequestBody dtoPedidos dtopedidos) {
        if (StringUtils.isBlank(dtopedidos.getNumeroPedido())) {
            return new ResponseEntity(new Mensaje("El nombre es obligatorio"), HttpStatus.BAD_REQUEST);
        }
        if (sPedidos.existsBynumeroPedido(dtopedidos.getNumeroPedido())) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }

        Pedidos pedidos = new Pedidos(
                dtopedidos.getNumeroPedido(),
                dtopedidos.getNumeroMesaPedido(),
                dtopedidos.getNombreClientePedido(),
                dtopedidos.getHorarioPedido(),
                dtopedidos.getPedido(),
                dtopedidos.getObservacionesPedido(),
                dtopedidos.getEstadoPedido(),
                dtopedidos.getPrecioPedido()
        );

        sPedidos.save(pedidos);
        return new ResponseEntity(new Mensaje("Educacion creada"), HttpStatus.OK);

    }

    @Operation(summary = "Según los id's obtenidos en pedidos/lista, edita la informacion del id al que se apunta")
    @PreAuthorize("hasRole('ADMIN')")
    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody dtoPedidos dtoPedidos) {
        if (!sPedidos.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        if (sPedidos.existsBynumeroPedido(dtoPedidos.getNumeroPedido()) && sPedidos.getBynumeroPedido(dtoPedidos.getNumeroPedido()).get().getId() != id) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }
        if (StringUtils.isBlank(dtoPedidos.getNumeroPedido())) {
            return new ResponseEntity(new Mensaje("El campo no puede estar vacio"), HttpStatus.BAD_REQUEST);
        }

        Pedidos pedidos = sPedidos.getOne(id).get();

        pedidos.setNumeroPedido(dtoPedidos.getNumeroPedido());
        pedidos.setNumeroMesaPedido(dtoPedidos.getNumeroMesaPedido());
        pedidos.setNombreClientePedido(dtoPedidos.getNombreClientePedido());
        pedidos.setHorarioPedido(dtoPedidos.getHorarioPedido());
        pedidos.setPedido(dtoPedidos.getPedido());
        pedidos.setObservacionesPedido(dtoPedidos.getObservacionesPedido());
        pedidos.setEstadoPedido(dtoPedidos.getEstadoPedido());
        pedidos.setPrecioPedido(dtoPedidos.getPrecioPedido());

        sPedidos.save(pedidos);

        return new ResponseEntity(new Mensaje("Pedido actualizado"), HttpStatus.OK);
    }
}
