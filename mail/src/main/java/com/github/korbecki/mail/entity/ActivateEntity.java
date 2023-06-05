package com.github.korbecki.mail.entity;

import com.github.korbecki.mail.enums.ActivateStatus;
import jakarta.persistence.*;
import lombok.Data;

import java.time.LocalDateTime;

@Entity(name = "ACTIVATE")
@Table
@Data
public class ActivateEntity {

    @Id
    @Column(name = "activate_id")
    private Long activateId;

    @Column(name = "is_activated")
    private boolean isActivated;

    @Column(name = "code")
    private String code;

    @Column(name = "status")
    @Enumerated(EnumType.ORDINAL)
    private ActivateStatus status;

    @Column(name = "expired_at")
    private LocalDateTime expiredAt;
}
