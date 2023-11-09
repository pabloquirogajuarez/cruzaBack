/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.cruza.Controller;

import com.cruza.Dto.dtoEmpleados;
import com.cruza.Entity.Empleados;
import com.cruza.Security.Controller.Mensaje;
import com.cruza.Service.SEmpleados;
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
@RequestMapping("/Empleados")
@CrossOrigin(origins = {"https://cruzafront.web.app", "http://localhost:4200"})
public class CEmpleados {

    @Autowired
    SEmpleados sEmpleados;

    @Operation(summary = "Trae una lista de los empleados creados")
    @GetMapping("/lista")
    public ResponseEntity<List<Empleados>> list() {
        List<Empleados> list = sEmpleados.list();
        return new ResponseEntity(list, HttpStatus.OK);
    }

    @Operation(summary = "Según los id's obtenidos en empleados/lista, puedes ver la informacion puedes ver la informacion de la misma")
    @GetMapping("/detail/{id}")
    public ResponseEntity<Empleados> getById(@PathVariable("id") int id) {
        if (!sEmpleados.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.BAD_REQUEST);
        }

        Empleados empleados = sEmpleados.getOne(id).get();
        return new ResponseEntity(empleados, HttpStatus.OK);
    }

    @Operation(summary = "Borrar un ingreso por id")
    @PreAuthorize("hasRole('ADMIN')")
    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id) {
        if (!sEmpleados.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        sEmpleados.delete(id);
        return new ResponseEntity(new Mensaje("Empleado eliminado"), HttpStatus.OK);
    }

    @Operation(summary = "Crear un ingreso")
    @PreAuthorize("hasRole('ADMIN')")
    @PostMapping("/create")
    public ResponseEntity<?> create(@RequestBody dtoEmpleados dtoempleados) {
        if (StringUtils.isBlank(dtoempleados.getNombreEmpleado())) {
            return new ResponseEntity(new Mensaje("El nombre es obligatorio"), HttpStatus.BAD_REQUEST);
        }
        if (sEmpleados.existsBynombreEmpleado(dtoempleados.getNombreEmpleado())) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }

        Empleados empleados = new Empleados(
                dtoempleados.getNombreEmpleado(),
                dtoempleados.getRolEmpleado()
        );

        sEmpleados.save(empleados);
        return new ResponseEntity(new Mensaje("Educacion creada"), HttpStatus.OK);

    }

    @Operation(summary = "Según los id's obtenidos en Empleados/lista, edita la informacion del id al que se apunta")
    @PreAuthorize("hasRole('ADMIN')")
    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody dtoEmpleados dtoEmpleados) {
        if (!sEmpleados.existsById(id)) {
            return new ResponseEntity(new Mensaje("No existe el ID"), HttpStatus.NOT_FOUND);
        }
        if (sEmpleados.existsBynombreEmpleado(dtoEmpleados.getNombreEmpleado()) && sEmpleados.getBynombreEmpleado(dtoEmpleados.getNombreEmpleado()).get().getId() != id) {
            return new ResponseEntity(new Mensaje("Ese nombre ya existe"), HttpStatus.BAD_REQUEST);
        }
        if (StringUtils.isBlank(dtoEmpleados.getNombreEmpleado())) {
            return new ResponseEntity(new Mensaje("El campo no puede estar vacio"), HttpStatus.BAD_REQUEST);
        }

        Empleados empleados = sEmpleados.getOne(id).get();

        empleados.setNombreEmpleado(dtoEmpleados.getNombreEmpleado());
        empleados.setRolEmpleado(dtoEmpleados.getRolEmpleado());

        sEmpleados.save(empleados);

        return new ResponseEntity(new Mensaje("Empleado actualizado"), HttpStatus.OK);
    }
}
