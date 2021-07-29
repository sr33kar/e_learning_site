package com.example.eLearning_site;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.example.eLearning_site.entities.Admin;
import com.example.eLearning_site.entities.Contact;
import com.example.eLearning_site.entities.Course;
import com.example.eLearning_site.entities.Feedback;
import com.example.eLearning_site.entities.User;
import com.example.eLearning_site.service.AdminService;
import com.example.eLearning_site.service.ContactService;
import com.example.eLearning_site.service.CourseService;
import com.example.eLearning_site.service.FeedbackService;
import com.example.eLearning_site.service.UserService;

@Controller
public class eLeariningController {
	@Autowired
	private UserService service;
	
	@Autowired
	private CourseService courseService;
	@Autowired
	private FeedbackService feedbackService;
	@Autowired
	private ContactService contactService;
	@Autowired
	private AdminService adminService;
	
	@RequestMapping(value = "/", method = RequestMethod.GET) 
	public String displayLogin(Model model) { 
	    model.addAttribute("user", new User()); 
	    return "userLogin"; 
	}
	private User globalUser= new User();
	private Admin globalAdmin= new Admin();
	
	@PostMapping("registered")
	public String userLogin(@ModelAttribute("userData") User user, Model model) {
		User u= service.get(user.userId);
		if(u==null) {
			System.out.println("hereeeeeeeeeeeeeeeeeeeeeee");
			service.save(user);
		}
		else {
			System.out.println(u.getUserId());
		    model.addAttribute("user", new User()); 
		    model.addAttribute("existedUsername",u.getUserId());
			return "userLogin";
		}

		model.addAttribute("user", user);
		List<Course> courseList = courseService.listAll();
		model.addAttribute("courseList", courseList);
		model.addAttribute("feedback", new Feedback());
		model.addAttribute("contact", new Contact());
		globalUser.setUserId(user.getUserId());
		globalUser.setPassword(user.getPassword());
		globalUser.setName(user.getName());
		return "userLoggedIn";
	}
	@PostMapping("loggedIn")
	public String userLogging(@ModelAttribute("userData") User user, Model model) {
		User u= service.get(user.getUserId());
		if(u==null) {
			System.out.println("hereeeeeeeeeeeeeeeeeeeeeee");
			model.addAttribute("error","Error: ");
			model.addAttribute("user", new User()); 
			System.out.println("1");
			return "userLogin";
		}
		else {
			if(!u.getPassword().equals(user.getPassword())) {
				model.addAttribute("user", new User()); 
				model.addAttribute("error","Error: ");
				System.out.println("2");
				return "userLogin";
			}
			System.out.println(u.getUserId());
		    
		}
		model.addAttribute("user", u);
		System.out.println(u.profilePic);
		List<Course> courseList = courseService.listAll();
		model.addAttribute("courseList", courseList);
		model.addAttribute("feedback", new Feedback());
		model.addAttribute("contact", new Contact());
		globalUser.setUserId(user.getUserId());
		globalUser.setPassword(user.getPassword());
		globalUser.setName(user.getName());
		return "userLoggedIn";
	}
	
	@PostMapping("feedback")
	public String submitFeedback(@ModelAttribute("feedbackData") Feedback feedback, Model model) {
		feedbackService.save(feedback);
		model.addAttribute("user", globalUser);
		List<Course> courseList = courseService.listAll();
		model.addAttribute("courseList", courseList);
		model.addAttribute("feedback", new Feedback());
		model.addAttribute("contact", new Contact());
		return "userLoggedIn";
	}
	
	@PostMapping("contact")
	public String submitContact(@ModelAttribute("contact") Contact contact, Model model) {
		contactService.save(contact);
		model.addAttribute("user", globalUser);
		List<Course> courseList = courseService.listAll();
		model.addAttribute("courseList", courseList);
		model.addAttribute("feedback", new Feedback());

		model.addAttribute("contact", new Contact());
		return "userLoggedIn";
	}
	
	@RequestMapping(value = "admin", method = RequestMethod.GET) 
	public String adminLogin(Model model) {
		model.addAttribute("admin", new Admin());
		return "adminLogin";
	}
	
	@PostMapping("adminLogin")
	public String adminLogging(@ModelAttribute("adminData") Admin admin, Model model) {
		Admin a= adminService.get(admin.getAdminId());
		if(a==null) {
			System.out.println("hereeeeeeeeeeeeeeeeeeeeeee");
			model.addAttribute("error","Error: ");
			model.addAttribute("admin", new Admin()); 
			System.out.println("1");
			return "adminLogin";
		}
		else {
			if(!a.getPassword().equals(admin.getPassword())) {
				model.addAttribute("admin", new Admin()); 
				model.addAttribute("error","Error: ");
				System.out.println("2");
				return "adminLogin";
			}
		    
		}
		model.addAttribute("admin", a);
		List<Course> courseList = courseService.listAll();

		List<Feedback> feedBackList = feedbackService.listAll();
		List<Contact> contactList = contactService.listAll();
		List<User> userList= service.listAll();
		model.addAttribute("courseList", courseList);
		model.addAttribute("feedbackList", feedBackList);
		model.addAttribute("contactList", contactList);

		model.addAttribute("userList", userList);
		
		model.addAttribute("course", new Course());
		globalAdmin.setAdminId(admin.getAdminId());
		globalAdmin.setPassword(admin.getPassword());
		globalAdmin.setName(admin.getName());
		return "adminLoggedIn";
	}
	
	@PostMapping("addCourse")
	public String addCourse(@ModelAttribute("courseData") Course course, Model model) {
		Course c= courseService.get(course.getCourseId());
		if(c.getCourseName().equals(course.getCourseId())) {
			model.addAttribute("error","Error: CourseID already exists");
			model.addAttribute("course", new Course());
			List<Course> courseList = courseService.listAll();

			List<Feedback> feedBackList = feedbackService.listAll();
			List<Contact> contactList = contactService.listAll();
			List<User> userList= service.listAll();
			model.addAttribute("courseList", courseList);
			model.addAttribute("feedbackList", feedBackList);
			model.addAttribute("contactList", contactList);

			model.addAttribute("userList", userList);
			
			model.addAttribute("course", new Course());
			Admin aa= adminService.get(globalAdmin.getAdminId());
			model.addAttribute("admin", aa);
			System.out.println("1");
			return "adminLoggedIn";
			
		}
			courseService.save(course);
			model.addAttribute("course", new Course());
			List<Course> courseList = courseService.listAll();

			List<Feedback> feedBackList = feedbackService.listAll();
			List<Contact> contactList = contactService.listAll();
			List<User> userList= service.listAll();
			model.addAttribute("courseList", courseList);
			model.addAttribute("feedbackList", feedBackList);
			model.addAttribute("contactList", contactList);

			model.addAttribute("userList", userList);
			
			model.addAttribute("course", new Course());
			Admin aa= adminService.get(globalAdmin.getAdminId());
			model.addAttribute("admin", aa);
		
		return "adminLoggedIn";
	}
}
