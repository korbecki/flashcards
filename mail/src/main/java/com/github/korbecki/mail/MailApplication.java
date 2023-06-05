package com.github.korbecki.mail;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.autoconfigure.domain.EntityScan;
import org.springframework.data.jpa.repository.config.EnableJpaRepositories;
import org.springframework.scheduling.annotation.EnableScheduling;

@SpringBootApplication
@EntityScan
@EnableScheduling
public class MailApplication {

	public static void main(String[] args) {
		SpringApplication.run(MailApplication.class, args);
	}

}
