package com.example.eLearning_site.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.eLearning_site.entities.User;

public interface UserRepository extends JpaRepository<User, String> {

}
