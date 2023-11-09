/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Controller;

import com.cruza.Dto.dtoIngresos;
import com.cruza.Entity.Ingresos;
import com.cruza.Security.Controller.Mensaje;
import com.cruza.Service.SIngresos;
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
@RequestMapping("/ingresos")
@CrossOrigin(origins = {"https://cruzafront.web.app", "http://localhost:4200"})
public class CIngresos {

    @Autowired
    SIngresos sIngresos;

    @Operation(summary = "Trae una lista de los ingresos creados")
    @GetMapping("/lista")
    public ResponseEntity<List<Ingresos>> list() {
        List<Ingresos> list = sIngresos.list();
        return new ResponseEntity(list, HttpStatus.OK);
    }

    @Operation(summary = "Según los id's obtenidos en ingresos/lista, puedes ver la informacion puedes ver la informacion de la misma")
    @GetMapping("/detail/{id}")
    public ResponseEntity<Ingresos> getById(@PathVariable("id") int id) {
        if (!sIngresos.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.BAD_REQUEST);
        }

        Ingresos ingresos = sIngresos.getOne(id).get();
        return new ResponseEntity(ingresos, HttpStatus.OK);
    }

    @Operation(summary = "Borrar un ingreso por id")
    @PreAuthorize("hasRole('ADMIN')")
    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id) {
        if (!sIngresos.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        sIngresos.delete(id);
        return new ResponseEntity(new Mensaje("Ingreso eliminado"), HttpStatus.OK);
    }

    @Operation(summary = "Crear un ingreso")
    @PreAuthorize("hasRole('ADMIN')")
    @PostMapping("/create")
    public ResponseEntity<?> create(@RequestBody dtoIngresos dtoingresos) {
        if (StringUtils.isBlank(dtoingresos.getFechaIngreso())) {
            return new ResponseEntity(new Mensaje("El nombre es obligatorio"), HttpStatus.BAD_REQUEST);
        }
        if (sIngresos.existsByfechaIngreso(dtoingresos.getFechaIngreso())) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }

        Ingresos ingresos = new Ingresos(
                dtoingresos.getFechaIngreso(),
                dtoingresos.getGananciaIngreso()
        );

        sIngresos.save(ingresos);
        return new ResponseEntity(new Mensaje("Educacion creada"), HttpStatus.OK);

    }

    @Operation(summary = "Según los id's obtenidos en Ingresos/lista, edita la informacion del id al que se apunta")
    @PreAuthorize("hasRole('ADMIN')")
    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody dtoIngresos dtoIngresos) {
        if (!sIngresos.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        if (sIngresos.existsByfechaIngreso(dtoIngresos.getFechaIngreso()) && sIngresos.getByfechaIngreso(dtoIngresos.getFechaIngreso()).get().getId() != id) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }
        if (StringUtils.isBlank(dtoIngresos.getFechaIngreso())) {
            return new ResponseEntity(new Mensaje("El campo no puede estar vacio"), HttpStatus.BAD_REQUEST);
        }

        Ingresos ingresos = sIngresos.getOne(id).get();

        ingresos.setFechaIngreso(dtoIngresos.getFechaIngreso());
        ingresos.setGananciaIngreso(dtoIngresos.getGananciaIngreso());

        sIngresos.save(ingresos);

        return new ResponseEntity(new Mensaje("Ingreso actualizado"), HttpStatus.OK);
    }
}
