package com.example.eLearning_site.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.example.eLearning_site.entities.Course;
import com.example.eLearning_site.repository.CourseRepository;

@Service
@Transactional
public class CourseService {
	@Autowired
	public CourseRepository repo;
	public List<Course> listAll() {
        return repo.findAll();
    }
     
    public void save(Course course) {
        repo.save(course);
    }
     
    public Course get(String id) {
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
