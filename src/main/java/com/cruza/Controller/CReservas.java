/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Controller;

import com.cruza.Dto.dtoReservas;
import com.cruza.Entity.Reservas;
import com.cruza.Security.Controller.Mensaje;
import com.cruza.Service.SReservas;
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
@RequestMapping("/reservas")
@CrossOrigin(origins = {"https://cruzafront.web.app", "http://localhost:4200"})
public class CReservas {

    @Autowired
    SReservas sReservas;

    @Operation(summary = "Trae una lista de los reservas creados")
    @GetMapping("/lista")
    public ResponseEntity<List<Reservas>> list() {
        List<Reservas> list = sReservas.list();
        return new ResponseEntity(list, HttpStatus.OK);
    }

    @Operation(summary = "Según los id's obtenidos en reservas/lista, puedes ver la informacion puedes ver la informacion de la misma")
    @GetMapping("/detail/{id}")
    public ResponseEntity<Reservas> getById(@PathVariable("id") int id) {
        if (!sReservas.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.BAD_REQUEST);
        }

        Reservas reservas = sReservas.getOne(id).get();
        return new ResponseEntity(reservas, HttpStatus.OK);
    }

    @Operation(summary = "Borrar un reserva por id")
    @PreAuthorize("hasRole('ADMIN')")
    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id) {
        if (!sReservas.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        sReservas.delete(id);
        return new ResponseEntity(new Mensaje("Reserva eliminado"), HttpStatus.OK);
    }

    @Operation(summary = "Crear un reserva")
    @PreAuthorize("hasRole('ADMIN')")
    @PostMapping("/create")
    public ResponseEntity<?> create(@RequestBody dtoReservas dtoreservas) {
        if (StringUtils.isBlank(dtoreservas.getNumeroReserva())) {
            return new ResponseEntity(new Mensaje("El nombre es obligatorio"), HttpStatus.BAD_REQUEST);
        }
        if (sReservas.existsBynumeroReserva(dtoreservas.getNumeroReserva())) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }

        Reservas reservas = new Reservas(
                dtoreservas.getNumeroReserva(),
                dtoreservas.getNombreClienteReserva(),
                dtoreservas.getTelefonoReserva(),
                dtoreservas.getFechaReserva(),
                dtoreservas.getHoraReserva(),
                dtoreservas.getNumeroPersonasReserva(),
                dtoreservas.getEventoReserva(),
                dtoreservas.getObservacionesReserva()
        );

        sReservas.save(reservas);
        return new ResponseEntity(new Mensaje("Educacion creada"), HttpStatus.OK);

    }

    @Operation(summary = "Según los id's obtenidos en reserva/lista, edita la informacion del id al que se apunta")
    @PreAuthorize("hasRole('ADMIN')")
    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody dtoReservas dtoReservas) {
        if (!sReservas.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        if (sReservas.existsBynumeroReserva(dtoReservas.getNumeroReserva()) && sReservas.getBynumeroReserva(dtoReservas.getNumeroReserva()).get().getId() != id) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }
        if (StringUtils.isBlank(dtoReservas.getNumeroReserva())) {
            return new ResponseEntity(new Mensaje("El campo no puede estar vacio"), HttpStatus.BAD_REQUEST);
        }

        Reservas reservas = sReservas.getOne(id).get();

        reservas.setNumeroReserva(dtoReservas.getNumeroReserva());
        reservas.setNombreClienteReserva(dtoReservas.getNombreClienteReserva());
        reservas.setTelefonoReserva(dtoReservas.getTelefonoReserva());
        reservas.setFechaReserva(dtoReservas.getFechaReserva());
        reservas.setHoraReserva(dtoReservas.getHoraReserva());
        reservas.setNumeroPersonasReserva(dtoReservas.getNumeroPersonasReserva());
        reservas.setEventoReserva(dtoReservas.getEventoReserva());
        reservas.setObservacionesReserva(dtoReservas.getObservacionesReserva());

        sReservas.save(reservas);

        return new ResponseEntity(new Mensaje("Reserva actualizado"), HttpStatus.OK);
    }
}
