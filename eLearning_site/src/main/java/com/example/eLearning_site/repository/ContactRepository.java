package com.example.eLearning_site.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.eLearning_site.entities.Contact;

public interface ContactRepository extends JpaRepository<Contact, Integer> {

}
