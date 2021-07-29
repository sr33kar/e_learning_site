package com.example.eLearning_site.entities;

import java.sql.Date;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name="user")
public class User {
	public User() {
		super();
		// TODO Auto-generated constructor stub
	}
	@Id
	public String userId;
	public String name;
	public String address;
	public String profilePic;
	public String phoneNum;
	public String email;
	public String password;
	public Date regDate = (Date) new java.sql.Date(System.currentTimeMillis());
	
	public Date getRegDate() {
		return regDate;
	}
	public void setRegDate(Date regDate) {
		this.regDate = regDate;
	}
	
	public User(String userId, String name, String address, String profilePic, String phoneNum, String email,
			String password) {
		super();
		this.userId = userId;
		this.name = name;
		this.address = address;
		this.profilePic = profilePic;
		this.phoneNum = phoneNum;
		this.email = email;
		this.password = password;
	}
	public String getUserId() {
		return userId;
	}
	public void setUserId(String userId) {
		this.userId = userId;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getAddress() {
		return address;
	}
	public void setAddress(String address) {
		this.address = address;
	}
	public String getProfilePic() {
		return profilePic;
	}
	public void setProfilePic(String profilePic) {
		this.profilePic = profilePic;
	}
	public String getPhoneNum() {
		return phoneNum;
	}
	public void setPhoneNum(String phoneNum) {
		this.phoneNum = phoneNum;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	
	
	
}
