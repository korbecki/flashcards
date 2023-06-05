package com.github.korbecki.mail.repository;

import com.github.korbecki.mail.entity.UserEntity;
import com.github.korbecki.mail.enums.ActivateStatus;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.Collection;
import java.util.List;
import java.util.Set;

@Repository
public interface UserRepository extends JpaRepository<UserEntity, Long> {
    @Query("select s from SYSTEM_USER s where s.activate.status = 'NEW'")
    List<UserEntity> getAllToMailSend();


}
