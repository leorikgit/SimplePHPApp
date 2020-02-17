FROM httpd
RUN apt-get update -y && apt-get install -y procps

COPY my-httpd.conf /usr/local/apache2/conf/my-httpd.conf
RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf \
&& echo "Include /usr/local/apache2/conf/my-httpd.conf" >> /usr/local/apache2/conf/httpd.conf
EXPOSE 80


