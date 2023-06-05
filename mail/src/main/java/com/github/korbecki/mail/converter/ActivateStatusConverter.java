package com.github.korbecki.mail.converter;

import com.github.korbecki.mail.enums.ActivateStatus;
import jakarta.persistence.AttributeConverter;
import jakarta.persistence.Converter;

@Converter(autoApply = true)
public class ActivateStatusConverter implements AttributeConverter<ActivateStatus, String> {
    @Override
    public String convertToDatabaseColumn(ActivateStatus attribute) {
        return attribute.name();
    }

    @Override
    public ActivateStatus convertToEntityAttribute(String dbData) {
        return ActivateStatus.valueOf(dbData);
    }
}
