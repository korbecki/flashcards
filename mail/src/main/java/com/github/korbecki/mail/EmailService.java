package com.github.korbecki.mail;

import com.github.korbecki.mail.entity.UserEntity;
import com.github.korbecki.mail.enums.ActivateStatus;
import com.github.korbecki.mail.repository.UserRepository;
import jakarta.transaction.Transactional;
import lombok.RequiredArgsConstructor;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.lang3.RandomStringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.mail.SimpleMailMessage;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Service;

import java.time.LocalDateTime;
import java.util.List;

@Service
@RequiredArgsConstructor
@Slf4j
public class EmailService {
    private static final int HASH_LEN = 6;

    private final JavaMailSender mailSender;
    private final UserRepository userRepository;

    @Value("${spring.mail.username}")
    private String emailAddress;

    public void sendEmail(String to, String subject, String body) {
        SimpleMailMessage message = new SimpleMailMessage();
        message.setFrom(emailAddress);
        message.setTo(to);
        message.setSubject(subject);
        message.setText(body);
        mailSender.send(message);
    }


    @Transactional
    @Scheduled(fixedDelay = 30_000, initialDelay = 1000)
    public void execute() {
        List<UserEntity> userEntityList = userRepository.getAllToMailSend();

        for (UserEntity entity : userEntityList) {
            String verificationCode = RandomStringUtils.randomAlphabetic(HASH_LEN).toUpperCase();

            sendEmail(entity.getEmail(), "Flashcard Verification", "Hello! That's your verification code: " + verificationCode);

            entity.getActivate().setCode(verificationCode);
            entity.getActivate().setExpiredAt(LocalDateTime.now().plusDays(1L));
            entity.getActivate().setStatus(ActivateStatus.SEND);

            log.info("Activation email send to " + entity.getEmail());
        }

    }

}