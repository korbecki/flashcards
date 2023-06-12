FROM eclipse-temurin:17-jdk-alpine
VOLUME /tmp
COPY mail/target/*.jar app.jar
ENTRYPOINT ["java","-jar","/app.jar"]