package com.github.korbecki.mail.entity;

import com.github.korbecki.mail.enums.ActivateStatus;
import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.time.LocalDateTime;

@Entity(name = "activate")
@Table(name = "activate")
@Data
@AllArgsConstructor
@NoArgsConstructor
public class ActivateEntity {

    @Id
    @Column(name = "activate_id")
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long activateId;

    @Column(name = "is_activated")
    private boolean isActivated;

    @Column(name = "code")
    private String code;

    @Column(name = "status")
    private ActivateStatus status;

    @Column(name = "expired_at")
    private LocalDateTime expiredAt;
}
