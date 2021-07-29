package com.example.eLearning_site.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.example.eLearning_site.entities.Contact;
import com.example.eLearning_site.repository.ContactRepository;

@Service
@Transactional
public class ContactService {
	@Autowired
	public ContactRepository repo;
	public List<Contact> listAll() {
        return repo.findAll();
    }
     
    public void save(Contact contact) {
        repo.save(contact);
    }
     
    public Contact get(int id) {
    	//System.out.println(repo.findById(id));
    	if (repo.findById(id).toString()== Optional.empty().toString()) {
    		return null;
    	}
        return repo.findById(id).get();
    }
     
    public void delete(int id) {
        repo.deleteById(id);
    }
}
