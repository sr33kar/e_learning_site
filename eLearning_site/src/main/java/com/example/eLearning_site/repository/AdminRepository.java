package com.example.eLearning_site.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.eLearning_site.entities.Admin;

public interface AdminRepository extends JpaRepository<Admin, String> {

}
