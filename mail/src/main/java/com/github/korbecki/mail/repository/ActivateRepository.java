package com.github.korbecki.mail.repository;

import com.github.korbecki.mail.entity.ActivateEntity;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ActivateRepository extends JpaRepository<ActivateEntity, Long> {
}
