package com.example.eLearning_site.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.example.eLearning_site.entities.Admin;
import com.example.eLearning_site.repository.AdminRepository;

@Service
@Transactional
public class AdminService {
	@Autowired
	private AdminRepository repo;
	public List<Admin> listAll() {
        return repo.findAll();
    }
     
    public void save(Admin admin) {
        repo.save(admin);
    }
     
    public Admin get(String id) {
    	//System.out.println(repo.findById(id));
    	if (repo.findById(id).toString()== Optional.empty().toString()) {
    		return null;
    	}
        return repo.findById(id).get();
    }
     
    public void delete(String id) {
        repo.deleteById(id);
    }
}
