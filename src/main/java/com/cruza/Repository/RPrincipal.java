/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cruza.Repository;

import com.cruza.Entity.Principal;
import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface RPrincipal extends JpaRepository<Principal, Integer>{
    public Optional<Principal> findByNombreE(String nombreE);
    public boolean existsByNombreE(String nombreE);
}
