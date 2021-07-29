package com.example.eLearning_site.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.example.eLearning_site.entities.User;



@Service
@Transactional
public class UserService {
	@Autowired
    private com.example.eLearning_site.repository.UserRepository repo;
     
    public List<com.example.eLearning_site.entities.User> listAll() {
        return repo.findAll();
    }
     
    public void save(User user) {
        repo.save(user);
    }
     
    public User get(String id) {
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
